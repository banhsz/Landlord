import React, {useState} from 'react';

function MyReactComponent() {
    const [name, setName] = useState("Szabi");
    const [age, setAge] = useState(27);
    function increaseAge() {
        setAge(age + 1);
    }

    return (
        <div>
            <h1>Hello {name} , you are {age} years old!</h1>
            <button onClick={increaseAge}>Click me</button>
            <input id='name-input' type='text' value={name} onChange={(e) => setName(e.target.value)}></input>
        </div>
    );
}

export default MyReactComponent;