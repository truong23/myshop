class Validator {
  constructor(formSelector) {
    this.formElement = document.querySelector(formSelector);
    this.formRules = {};
    this.validationRules = {
      required(value) {
        return value ? undefined : "Vui lòng nhập vào trường này";
      },
      email(value) {
        const regex =
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(value) ? undefined : "Vui lòng nhập email hợp lệ";
      },
      min(min) {
        return function (value) {
          return value.length >= min
            ? undefined
            : `Vui lòng nhập tối thiểu ${min} kí tự`;
        };
      },
      confirm(value) {
        return value ===
          this.formElement.querySelector("#password").value
          ? undefined
          : "Mật khẩu nhập lại chưa chính xác";
      },
      match(value) {
        return value !==
          this.formElement.querySelector("#current_password").value
          ? undefined
          : "Mật khẩu này phải khác mật khẩu cũ ";
      },
    };

    this.inputs = [...this.formElement.querySelectorAll("[name][rules]")];
    for (this.input of this.inputs) {
      this.rules = this.input.getAttribute("rules").split("|");

      for (this.rule of this.rules) {
        if (this.formRules) {
          this.isRuleHasValue = this.rule.includes(":");
          this.inputRule = this.validationRules[this.rule];
          if (this.isRuleHasValue) {
            this.ruleInfo = this.rule.split(":");
            this.inputRule = this.validationRules[this.ruleInfo[0]](
              this.ruleInfo[1]
            );
          }

          if (!Array.isArray(this.formRules[this.input.name])) {
            this.formRules[this.input.name] = [];
          }
          this.formRules[this.input.name].push(this.inputRule);
        }
      
      }
      this.input.onblur = this.handleValidate;
      this.input.oninput = this.handleClearInvalid;
    }

    this.formElement.onsubmit = this.handleOnSubmit;
  }

  handleValidate = (e) => {
    this.formParent = e.target.closest(".form-group");
    this.errorElement = this.formParent.querySelector(".form-message");
    this.errorMessage;

    this.rules = this.formRules[e.target.name];

    for (this.rule of this.rules) {
      this.errorMessage = this.rule(e.target.value);
      if (this.errorMessage) break;
    }

    // for (this.rule of this.rules) {
    //   switch (e.target.type) {
    //     case "checkbox":
    //     case "radio":
    //       this.errorMessage = this.rule(
    //         this.formElement.querySelector('input[name = "gender"]:checked')
    //       );
    //       break;
    //     default:
    //       this.errorMessage = this.rule(e.target.value);
    //       break;
    //   }
    //   if (this.errorMessage) break;
    // }

    if (this.errorMessage) {
      this.formParent.classList.add("invalid");
      this.errorElement.innerText = this.errorMessage;
    } else {
      this.formParent.classList.remove("invalid");
      this.errorElement.innerText = "";
    }

    return !!this.errorMessage;
  };

  handleClearInvalid = (e) => {
    this.formParent = e.target.closest(".form-group");
    this.errorElement = this.formParent.querySelector(".form-message");
    this.formParent.classList.remove("invalid");
    this.errorElement.innerText = "";
  };

  handleOnSubmit = (e) => {
    e.preventDefault();
    this.formValid = true;

    for (this.input of this.inputs) {
      this.isInValid = this.handleValidate({ target: this.input });
      if (this.isInValid) {
        this.formValid = false;
      }
    }
    if (this.formValid) {
      this.formElement.submit();
    }
  };
}
