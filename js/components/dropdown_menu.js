import React from 'react';
import Dropdown_Menu_Item from './dropdown_menu_item';

export default class Dropdown_Menu extends React.Component {
	render() {
		const menu_elements = this.props.menu_items.map((item) =>
			<Dropdown_Menu_Item 
				key={item.key} 
				menu_item={item} 
				on_menu_click={this.props.on_menu_click}
				top_menu={true}
			/>
		);

		return(
			<div id="dropdown-menu">
				{menu_elements}
			</div>
		);
	}
}