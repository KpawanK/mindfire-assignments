import React from 'react';

import Aux from '../../hoc/Aux';
import classes from './Layout.css';
import Toolbar from '../Navigation/Toolbar/Toolbar';
import SideDrawer from '../Navigation/SideDrawer/SideDrawer';

const layout = (props) => (
    <Aux>
        <Toolbar />
        <SideDrawer />
        {/* in this i will o/p the component we wrap with this layout so props argument accepted */}
        <main className={classes.Content}>
            {props.children}
        </main>
    </Aux>
);

export default layout;