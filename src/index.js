import { render } from "@wordpress/element";

import "./style.scss";

const { slug } = wpReactBackendSettings;

const components = [];

export const registerSettingsPanel = (Component) => {
  components.push(Component);
};

const Settings = () => {
  return (
    <div>
      <h1>Settings</h1>
      <div className={slug}></div>
    </div>
  );
};

window.addEventListener("load", function () {
  const wrapper = document.querySelector(".wp-react-backend-settings-wrapper");
  if (!wrapper) {
    return;
  }
  const attributes = wrapper.dataset;
  render(<Settings {...attributes} />, wrapper);

  const inner = document.querySelector("." + slug);
  if (!inner) {
    return;
  }
  render(
    <div>
      {components.map((component) => {
        return component;
      })}
    </div>,
    inner
  );
});
