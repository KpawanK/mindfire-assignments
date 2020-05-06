import React from 'react';

import Aux from '../../hoc/Aux';
import classes from './Layout.css';

const layout = (props) => (
    <Aux>
        <div>Toolbar, SideDrawer, Backdrop</div>
        {/* in this i will o/p the component we wrap with this layout so props argument accepted */}
        <main className={classes.Content}>
            {props.children}
        </main>
    </Aux>
);

export default layout;