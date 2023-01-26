import { render } from "@wordpress/element";

import "./style.scss";

export const registerSettingsPanel = (title, component) => {
  return (
    <div>
      <h2>{title}</h2>
      <component />
    </div>
  );
};

const Settings = () => {
  return <h2>Settings</h2>;
};

window.addEventListener("load", function () {
  const wrapper = document.querySelector(".wp-react-backend-settings-wrapper");
  if (!wrapper) {
    return;
  }
  const attributes = wrapper.dataset;
  render(<Settings {...attributes} />, wrapper);
});
