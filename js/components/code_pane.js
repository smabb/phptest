import React from 'react';

export default class Code_Pane extends React.Component {
	static defaultProps = {
		code: '',
	};

	componentDidMount = () => {
		const editor = ace.edit(this.el);
		editor.setTheme("ace/theme/clouds");
		editor.getSession().setMode("ace/mode/php");
		editor.setShowPrintMargin(false);
		editor.setValue(this.props.code);
		editor.commands.addCommand({
			name: 'runCode',
			bindKey: {win: 'Ctrl-Enter',  mac: 'Command-Enter'},
			exec: (editor) => this.props.on_editor_event('run', editor)
		});
		editor.on('change', () => this.props.on_code_change(editor.getValue()));
		this.editor = editor;
	};

	componentDidUpdate = (prev_props, prev_state) => {
		if (this.props.code != this.editor.getValue()){
			this.editor.setValue(this.props.code);
			this.editor.clearSelection();
		}
	};

	render() {
		return(
			<div id="code-pane" ref={(el) => this.el = el}></div>
		);
	}
}