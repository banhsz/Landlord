import React from 'react';
import {useDispatch, useSelector} from "react-redux";

function DataTableComponent() {
    const apartmentData = useSelector(state => state.apartmentData); // Access Redux state
    const dispatch = useDispatch();

    async function getApps() {
        await fetch('http://landlord.backend/api/your-action')
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                dispatch({ type: 'loadApartments', payload: data});
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    return (
        <div>
            <p>{JSON.stringify(apartmentData)}</p>
            <button onClick={getApps}>GET APPS</button>
        </div>
    );
}
export default DataTableComponent;