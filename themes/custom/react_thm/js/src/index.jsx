import React from 'react'
import ReactDOM from 'react-dom'
import { hot } from 'react-hot-loader/root';

/* Import Components */
import NodeReadWrite from "./components/NodeReadWrite";

const Main = hot(() => (
  <NodeReadWrite/>
));

ReactDOM.render(<Main/>, document.getElementById('react-app'));