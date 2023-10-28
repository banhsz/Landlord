import React, {useState} from 'react';
import DataTableComponent from "./DataTableComponent";

function AppComponent() {
    const [name, setName] = useState("Szabi");
    const [age, setAge] = useState(27);
    function increaseAge() {
        setAge(age + 1);
    }

    return (
        <div>
            <div className={'container d-none'}>
                <div className={'row'}>
                    <div className={'col-sm-6'}>
                        <p>Stuff left</p>
                        <button className={'btn btn-success'}><i className={'fa fa-plus'}></i>Click me</button>
                    </div>
                    <div className={'col-sm-6'}>
                        <p>Stuff right</p>
                    </div>
                </div>
            </div>

            <h1>Hello {name}, you are {age} years old!</h1>
            <button onClick={increaseAge}>Click me</button>
            <input id='name-input' type='text' value={name} onChange={(e) => setName(e.target.value)}></input>

            <DataTableComponent/>
        </div>
    );
}

export default AppComponent;