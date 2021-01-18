import React from "react";
import { Button } from "primereact/button";
import logo from "../../assets/logo_bricks.png";
import { BrowserRouter as Link } from "react-router-dom";
import "./about.scss";

function About() {
  return (
    <div>
      <div className="home__header">
        <nav>
          <img className="home__logo" src={logo}></img>

          <ul>
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>
              <Link to="/about">About</Link>
            </li>
          </ul>
        </nav>
      </div>
      <div className="home__content">
        <div>HELLO WORLD!</div>
        <Button label="Primary" />
        <Button label="Secondary" className="p-button-secondary" />
        <Button label="Success" className="p-button-success" />
        <Button label="Info" className="p-button-info" />
        <Button label="Warning" className="p-button-warning" />
        <Button label="Danger" className="p-button-danger" />
      </div>
    </div>
  );
}

export default About;
