import React, { useRef, useState } from "react";
import { Button } from "primereact/button";
import logo from "../../assets/logo_bricks.png";
import { BrowserRouter as Link } from "react-router-dom";
import "./home.scss";
import { SplitButton } from "primereact/splitbutton";
import { Toast } from "primereact/toast";
import { InputText } from "primereact/inputtext";

function Home() {
  const [value1, setValue1] = useState("");

  const toast = useRef(null);

  const exportMenuItems = [
    {
      label: "Update",
      icon: "pi pi-refresh",
      command: () => {
        toast.current.show({
          severity: "success",
          summary: "Updated",
          detail: "Data Updated",
        });
      },
    },
    {
      label: "Delete",
      icon: "pi pi-times",
      command: () => {
        toast.current.show({
          severity: "success",
          summary: "Delete",
          detail: "Data Deleted",
        });
      },
    },
    {
      label: "React Website",
      icon: "pi pi-external-link",
      command: () => {
        window.location.href = "https://facebook.github.io/react/";
      },
    },
    {
      label: "Upload",
      icon: "pi pi-upload",
      command: () => {
        window.location.hash = "/fileupload";
      },
    },
  ];

  const save = () => {

    console.log("Crear JSON button")


    toast.current.show({
      severity: "success",
      summary: "Success",
      detail: "Data Saved",
    });
  };

  return (
    <div className="home">
      <Toast ref={toast}></Toast>

      <div className="home__header">
        <img className="home__logo" src={logo}></img>
      </div>

      <div className="subheader">
        <Button label="Cancelar" className="p-button-text p-button-plain" />

        <SplitButton
          label="Crear JSON"
          icon="pi pi-plus"
          onClick={save}
          model={exportMenuItems}
          className="p-button-success"
        ></SplitButton>
      </div>

      <div className="home__content">
        <div className="video-embed">
          <div className="form__container">
            <div className="form__title">Vídeo de danza</div>
            <div className="p-field">
              <label htmlFor="video-title" className="p-d-block">
                Título
              </label>
              <InputText
                id="video-title"
                aria-describedby="video-title-help"
                className="p-d-block form__input"
              />
              <small id="video-title-help" className="p-d-block">
                Enter your username to reset your password.
              </small>
            </div>

            <div className="p-field">
              <label htmlFor="video-url" className="p-d-block">
                URL del video
              </label>
              <InputText
                id="video-url"
                aria-describedby="video-url-help"
                className="p-d-block form__input"
              />
              <small id="video-url-help" className="p-d-block">
                Enter your username to reset your password.
              </small>
            </div>
          </div>
        </div>
        {/* <Button label="Descargar JSON" />
        <Button label="Secondary" className="p-button-secondary" />
        <Button label="Guardar" className="p-button-success" />
        <Button label="Info" className="p-button-info" />
        <Button label="Warning" className="p-button-warning" />
        <Button label="Cancelar" className="p-button-danger" /> */}
      </div>
    </div>
  );
}

export default Home;
