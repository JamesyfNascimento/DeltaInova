
    import React from 'react';  
    import ReactDOM from 'react-dom';  
    import './index.css';  
    import * as serviceWorker from './serviceWorker';  
    import '../node_modules/bootstrap/dist/css/bootstrap.min.css';  
    import AlunoAcoesApp from './Aluno/acoes';  
    ReactDOM.render(<AlunoAcoesApp />, document.getElementById('root'));  
    serviceWorker.unregister();  
