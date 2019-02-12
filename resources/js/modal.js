const VueModal = class VueModal {
    constructor(image = {}, visible = true) {
        this.image = image || {};
        this.visible = visible;
    }

    image(image) {
        this.image = image;

        return this;
    }

    show() {
        window.bus.$emit('show-modal', this);

        return this;
    }

    dismiss() {
        window.bus.$emit('dismiss-modal');

        return this;
    }
};

export default VueModal;
