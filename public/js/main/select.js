class Select {
  static #classes = {
    select: "form-select",
    wrapper: "form-floating",
    active: "focus",
  };
  static for(select) {
    return {
      set: (value, dispatchEvent = true) =>
        this.#set(select, value, dispatchEvent),
      toggle: (type) => this.#toggle(select, type),
      createOptions: (
        values,
        { value = "value", title = "title", selected = "selected" } = {}
      ) => this.#createOptions(select, values, { value, title, selected }),
      clear: () => this.#clear(select),
      reset: () => this.#reset(select),
    };
  }
  static get(select) {
    return select?.value;
  }
  static #set(select, value, dispatchEvent = true) {
    select.value = value;
    this.#toggle(select);
    if (dispatchEvent) select?.dispatchEvent(new InputEvent(MY_EVENTS.change));
    return this.for(select);
  }
  static #toggle(select, type) {
    const parent = select.closest(`.${this.#classes.wrapper}`);

    switch (type) {
      case "open": {
        parent?.classList?.add(this.#classes.active);
        break;
      }
      case "close": {
        if (!select?.value) parent?.classList?.remove(this.#classes.active);
        break;
      }
      default: {
        if (select?.value) parent?.classList?.add(this.#classes.active);
        else parent?.classList?.remove(this.#classes.active);
        break;
      }
    }

    return this.for(select);
  }
  static #createOptions(
    select,
    values,
    { value = "value", title = "title", selected = "selected" } = {}
  ) {
    values.forEach((v) => {
      const option = document.createElement("option");
      option.value = v?.[value];
      option.innerHTML = v?.[title];
      if (v?.[selected]) option.selected = true;
      select.append(option);
    });

    return this.for(select);
  }
  static #clear(select) {
    select.innerHTML = "";
    return this.for(select);
  }
  static #reset(select) {
    this.#clear(select);
    this.#set(select, "");
    return this.for(select);
  }
  static init(root = document) {
    const selects = root?.querySelectorAll(`.${this.#classes.select}`);
    selects.forEach((select) => {
      const parent = select?.closest(`.${this.#classes.wrapper}`);
      const label = parent?.querySelector("label");
      const uniqueId = select?.id || genId();
      if (!select?.id) select.id = uniqueId;
      label?.setAttribute("for", uniqueId);

      this.#toggle(select);
      select.addEventListener("input", (e) => {
        this.#toggle(e.target);
      });
      select.addEventListener("focus", (e) => {
        this.#toggle(e.target, "open");
      });
      select.addEventListener("blur", (e) => {
        this.#toggle(e.target, "close");
      });
    });
  }
}

Select.init();
