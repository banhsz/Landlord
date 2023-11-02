import React from 'react';
import {useDispatch, useSelector} from "react-redux";
import {DataGrid, GridActionsCellItem,} from '@mui/x-data-grid';
import DeleteIcon from '@mui/icons-material/Delete';
import {loadData} from "./apartmentSlice";

function DataTableComponent() {
    const apartmentData = useSelector(state => state.apartmentSlice.apartmentArray); // Access Redux state
    const dispatch = useDispatch();

    const rows = apartmentData.map((data, index) => ({
        id: index + 1,
        col1: data.name,
        col2: data.address,
        col3: data.rent
    }));

    const columns = [
        { field: 'col1', headerName: 'Name', flex: 1, editable: true},
        { field: 'col2', headerName: 'Address', flex: 1, editable: true},
        { field: 'col3', headerName: 'Rent', flex: 1, editable: true},
        {
            field: 'actions',
            type: 'actions',
            getActions: (params) => [
                <GridActionsCellItem icon={<DeleteIcon />} onClick={() => deleteItem(params.id)} label="Delete" />,
            ]
        }
    ];

    async function getApps() {
        //TODO: there must be a better way
        //DOCKER
        //await fetch('http://localhost:21080/api/your-action')
        //XAMMP
        await fetch('http://landlord.backend/api/your-action')
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                dispatch(loadData(data));
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function deleteItem(id) {
        console.log('deleting '+ id);
    }

    return (
        <div>
            <button onClick={getApps} className={"btn btn-primary"}>Load apps</button>
            <div style={{ height: 600, width: '100%' }}>
                <DataGrid rows={rows} columns={columns} />
            </div>
        </div>
    );
}
export default DataTableComponent;