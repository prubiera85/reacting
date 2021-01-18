import React from "react";
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

// import 'primereact/resources/themes/mdc-light-indigo/theme.css';
import './themes/mdc-light-indigo/theme.css';
import './themes/mdc-light-indigo/theme_overrides.scss';
import 'primereact/resources/primereact.min.css';
import 'primeicons/primeicons.css';
import 'primeflex/primeflex.css';

import Home from "./pages/home/Home";
import About from "./pages/about/About";

import "./App.scss";

function App() {
  return (
    <Router>
      <div className="App">
        {/* A <Switch> looks through its children <Route>s and
          renders the first one that matches the current URL. */}
        <Switch>
          <Route path="/about">
            <About />
          </Route>

          <Route path="/">
            <Home />
          </Route>

        </Switch>
      </div>
    </Router>
  );
}

export default App;
