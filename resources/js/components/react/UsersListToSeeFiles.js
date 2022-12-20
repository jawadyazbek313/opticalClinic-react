import React, { StrictMode, useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { createRoot } from 'react-dom/client';
import TabsForTodayOrAllPatients from './Home/TabsForTodayOrAllPatients';
import UsersListWithShowFileAction from './Home/UsersListWithShowFileAction';

export default function UsersListToSeeFiles() {
    const [UsersData,setUsersData] = useState([]);
    const [isLoading,setisLoading]=useState(false);

    useEffect(() => {


    }, [])
    if(!isLoading)
    return (<>
    <StrictMode>
    <TabsForTodayOrAllPatients />

    </StrictMode></>);
    return (
        <>
        <StrictMode>
        <h1>Hello React!</h1>
        </StrictMode>
        </>
    );
}

if (document.getElementById('hello-react')) {
    const root = createRoot(document.getElementById('hello-react'));
    root.render(<UsersListToSeeFiles />);
}
