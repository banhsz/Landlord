import React from 'react';
//import ReactDOM from 'react-dom';
import MyReactComponent from "./MyReactComponent";
import {createRoot} from "react-dom/client";

const container= document.getElementById('root');
const root = createRoot(container);
root.render(<MyReactComponent />);


/* Old method until react 17
ReactDOM.render(
    <React.StrictMode>
        <MyReactComponent />
    </React.StrictMode>,
    document.getElementById('root')
);
*/