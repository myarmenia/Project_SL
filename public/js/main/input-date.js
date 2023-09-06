class DateInput {
  static #regexp = /\d{2}\-\d{2}\-\d{4}$/;
  static #classes = {
    wrapper: "input-date-wrapper",
    active: "focus",
    store: `[role="store"]`,
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
    const store = parent?.querySelector(`input[role="store"]`);
    switch (type) {
      case "open": {
        parent?.classList?.add(this.#classes.active);
        break;
      }
      case "close": {
        if (!store?.value) parent?.classList?.remove(this.#classes.active);
        break;
      }
      default: {
        if (store?.value) parent?.classList?.add(this.#classes.active);
        else parent?.classList?.remove(this.#classes.active);

        break;
      }
    }
    return this.for(input);
  }
  static #set(input, value, dispatchEvent = true) {
    const parent = input.closest(`.${this.#classes.wrapper}`);
    const placeholder = parent.querySelector(`[role="value"]`);
    const store = parent.querySelector(this.#classes.store); // input to store real value to send to server

    if (!value) value = "";
    value = this.#convert(value);
    store && (store.value = value);
    placeholder && (placeholder.innerHTML = value);
    if (dispatchEvent && store)
      store.dispatchEvent(new InputEvent(MY_EVENTS.change));
    this.#toggle(input);

    return this.for(input);
  }
  static #convert(value) {
    let new_value;
    new_value = value.split("-").filter(Boolean);
    if (!this.#regexp.test(value)) new_value.reverse();
    if (!value) return "";
    return new_value.join("-");
  }
  static init(root = document) {
    const input_date = root.querySelectorAll(
      `.${this.#classes.wrapper} input[type='date']`
    );

    input_date.forEach((input) => {
      const parent = input.closest(`.${this.#classes.wrapper}`);
      const store = parent.querySelector(`input[role="store"]`);
      const labels = parent?.querySelectorAll("label");
      const uniqueId = input?.id || genId();

      if (!input?.id) input.id = uniqueId;
      labels.forEach((l) => l?.setAttribute("for", uniqueId));

      parent.addEventListener("click", (e) => {
        const p = e.target.closest(`.${this.#classes.wrapper}`) || e.target;
        p?.querySelector("input[type='date']")?.showPicker();
      });

      this.#set(input, store?.value);
      input.addEventListener("input", (e) => {
        this.#set(e.target, e.target?.value);
      });
      input.addEventListener("focus", (e) => {
        this.#toggle(e.target, "open");
      });
      input.addEventListener("blur", (e) => {
        this.#toggle(e.target, "close");
      });
    });
  }
}
DateInput.init();
