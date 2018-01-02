import React from 'react';
import $ from 'jquery';

export default class Dropdown_Menu_Item extends React.Component {
	on_mouse_enter = () => {
		$(this.submenu).stop().slideDown('fast');
	};

	on_mouse_leave = () => {
		$(this.submenu).stop().slideUp('fast');
	};

	render() {
		const menu_item = this.props.menu_item;

		if (menu_item.hasOwnProperty('submenu')) {
			const class_name = this.props.top_menu ? 'drop' : 'subdrop';
			const menu_elements = menu_item.submenu.map((item) =>
				<Dropdown_Menu_Item 
					key={item.key} 
					menu_item={item} 
					on_menu_click={this.props.on_menu_click}
					top_menu={false}
				/>
			);

			return(
				<div className={class_name} onMouseEnter={this.on_mouse_enter} onMouseLeave={this.on_mouse_leave}>
					<span onClick={() => this.props.on_menu_click(menu_item.key)}>{menu_item.title}</span>
					<div ref={(el) => this.submenu = el}>
						{menu_elements}
					</div>
				</div>
			);
		}
		else {
			return(
				<div className="clickable"><span onClick={() => this.props.on_menu_click(menu_item.key)}>{menu_item.title}</span></div>
			);
		}
	}
}