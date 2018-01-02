import React from 'react';

export default class Result_Pane extends React.Component {
	render() {
		return(
			<div id="result-pane">
				<iframe id="result-iframe" name="result-iframe"></iframe>
			</div>
		);
	}
}