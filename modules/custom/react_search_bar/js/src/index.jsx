import React from 'react';
import ReactDOM from 'react-dom';

/* Import Components */
import NodeListOnly from "./components/NodeListOnly";

const Main = () => (
  <NodeListOnly />
);

ReactDOM.render(<Main/>, document.getElementById('react-search-app'));