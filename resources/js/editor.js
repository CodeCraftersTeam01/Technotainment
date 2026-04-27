import Editor from "@toast-ui/editor";
import "@toast-ui/editor/dist/toastui-editor.css";

window.createEditor = (selector) => {
    return new Editor({
        el: document.querySelector(selector),
        height: "400px",
        initialEditType: "markdown",
        placeholder: "Write something cool!",
    });
};
