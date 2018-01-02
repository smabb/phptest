import React from 'react';
import Dropdown_Menu from './dropdown_menu';

export default class Main_Menu extends React.Component {
	render() {
		return(
			<div id="main-menu">
				<div id="title">Run PHP Code</div>
				<Dropdown_Menu 
					menu_items={this.props.menu_items}
					on_menu_click={this.props.on_menu_click}
				/>
			</div>
		);
	}
}