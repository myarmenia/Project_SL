class Input {
  static #classes = {
    wrapper: "form-floating",
    active: "focus",
    input: `:is(input, textarea, :not([type="date"])).form-control`,
    // input: `input.form-control:is(input:not([type="date"]), textarea)`,
  };
  static for(input) {
    return {
      toggle: (type) => this.#toggle(input, type),
      set: (value, dispatchEvent = true) =>
        this.#set(input, value, dispatchEvent),
    };
  }
  static get(input) {
    return input?.value;
  }
  static #toggle(input, type) {
    const parent = input.closest(`.${this.#classes.wrapper}`);
    switch (type) {
      case "open": {
        parent?.classList?.add(this.#classes.active);
        break;
      }
      case "close": {
        if (!input?.value) parent?.classList?.remove(this.#classes.active);
        break;
      }
      default: {
        if (input?.value) parent?.classList?.add(this.#classes.active);
        else parent?.classList?.remove(this.#classes.active);

        break;
      }
    }

    return this.for(input);
  }
  static #set(input, value, dispatchEvent = true) {
    if (!value) value = "";
    input.value = value;
    if (dispatchEvent) input.dispatchEvent(new InputEvent(MY_EVENTS.change));
    this.#toggle(input);
    return this.for(input);
  }
  static init(root = document) {
    const input_date = root.querySelectorAll(
      `.${this.#classes.wrapper} ${this.#classes.input}`
    );

    input_date.forEach((input) => {
      const parent = input.closest(`.${this.#classes.wrapper}`);
      const label = parent?.querySelector("label");
      const uniqueId = input?.id || genId();

      if (!input?.id) input.id = uniqueId;
      label?.setAttribute("for", uniqueId);

      this.#set(input, input?.value);
      input.addEventListener("focus", (e) => {
        this.#toggle(e.target, "open");
      });
      input.addEventListener("blur", (e) => {
        this.#toggle(e.target, "close");
      });
    });
  }
}

Input.init();
