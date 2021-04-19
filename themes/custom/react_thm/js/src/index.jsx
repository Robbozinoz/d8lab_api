import React from 'react';
import ReactDOM from 'react-dom';
// import NodeListOnly from "./components/NodeListOnly";
import NodeReadWrite from "./components/NodeReadWrite";
import DrupalProjectStats from './components/DrupalProjectStats';

const Main = () => (
  <React.Fragment>
    <DrupalProjectStats projectName="drupal" />
    {/* <NodeListOnly /> */}
  </React.Fragment>
);

ReactDOM.render(<Main/>, document.getElementById('react-app-first'));
ReactDOM.render(<NodeReadWrite />, document.getElementById('react-app'));