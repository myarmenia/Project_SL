class FileInput {
  static #classes = {
    parent: {
      container: "file-upload-container",
      content: "file-upload-content",
      input: "file-upload",
      btn: "file-upload-btn",
      render_type: "data-render-type",
    },
    item: {
      index: "file-box",
      title: "file-box-title",
      delete: "delete",
      delete_id_attr: "data-id",
    },
  };

  static for(input) {
    return {
      set: (files, dispatchEvent = true) =>
        this.#set(input, files, dispatchEvent),
      removeOne: (item) => this.#removeOne(item),
      reset: () => this.#reset(input),
    };
  }
  static #set(input, files, dispatchEvent = true) {
    const parent = input.closest(`.${this.#classes.parent.container}`);
    const content = parent.querySelector(`.${this.#classes.parent.content}`);
    const render_type = input?.getAttribute(`[${render_type}]`);
    // const render_type = input?.getAttribute("data-href-type") || "default";

    this.#reset(input);

    switch (render_type) {
      case "none": {
        break;
      }
      default: {
        [...files].forEach((file, i) => {
          const div = document.createElement("div");
          div.setAttribute(this.#classes.item.delete_id_attr, i);
          div.className = this.#classes.item.index;
          div.innerHTML = `
            <div class="${this.#classes.item.title}">
                <a target="blank" href="${URL.createObjectURL(file)}">
                  <i class="bi bi-file-earmark-arrow-down-fill"></i>
                  <span>${file?.name}</span>
                </a>
            </div>
            <i class="bi bi-x-circle-fill ${this.#classes.item.delete}"></i>
            `;

          content.append(div);

          div
            ?.querySelector(`.${this.#classes.item.delete}`)
            ?.addEventListener("click", (e) => this.#removeOne(e.target));
        });
        break;
      }
    }

    input.files = files;

    if (dispatchEvent) input?.dispatchEvent(new InputEvent(MY_EVENTS.change));
    return this.for(input);
  }
  static get(input) {
    return [...input?.files];
  }
  static #removeOne(item) {
    item = item?.closest(`.${this.#classes.item.index}`) || item;
    const parent = item.closest(`.${this.#classes.parent.container}`);
    const content = parent.querySelector(`.${this.#classes.parent.content}`);
    const input = parent.querySelector(`.${this.#classes.parent.input}`);
    const id = item?.getAttribute(this.#classes.item.delete_id_attr);
    const dt = new DataTransfer();

    [...input.files].forEach((item, i) => {
      if (i != id) dt.items.add(item);
    });
    input.files = dt.files;

    item?.closest(`.${this.#classes.item.index}`)?.remove();
    content
      .querySelectorAll(`.${this.#classes.item.delete}`)
      .forEach((elem, i) => {
        elem.setAttribute(this.#classes.item.delete_id_attr, i);
      });

    return this.for(input);
  }
  static #reset(input) {
    const parent = input.closest(`.${this.#classes.parent.container}`);
    const content = parent.querySelector(`.${this.#classes.parent.content}`);

    if (content) content.innerHTML = "";
    input.files = new DataTransfer().files;
    input?.dispatchEvent(new InputEvent(MY_EVENTS.change));
    return this.for(input);
  }
  static init(root = document) {
    const file_uploads = root.querySelectorAll(
      `.${this.#classes.parent.input}`
    );

    file_uploads.forEach((input) => {
      const parent = input.closest(`.${this.#classes.parent.container}`);
      const label_btn = parent.querySelector(`.${this.#classes.parent.btn}`);
      const uniqueId = input.id || genId();

      input.id = uniqueId;
      label_btn.setAttribute("for", uniqueId);

      input.addEventListener("change", (e) => {
        this.#set(e.target, e.target?.files);
      });
    });
  }
}

FileInput.init();
