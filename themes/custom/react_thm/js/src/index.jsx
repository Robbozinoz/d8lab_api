import React from 'react';
import ReactDOM from 'react-dom';

/* Import Components */
import DrupalProjectStats from './components/DrupalProjectStats';

const Main = () => (
  <DrupalProjectStats projectName="drupal" />
);

ReactDOM.render(<Main/>, document.getElementById('react-app'));