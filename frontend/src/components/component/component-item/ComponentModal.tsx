import React from 'react';
import { Modal } from 'antd';
import { GetComponentDto } from '../../../models/component/get-component.dto';
import ComponentItem from './ComponentItem';

interface ComponentModalProps {
	component: GetComponentDto;
	open: boolean;
	onCancel: () => void;
}

const ComponentModal: React.FC<ComponentModalProps> = ({
	component,
	open,
	onCancel,
}) => {
	return (
		<Modal
			style={{ minWidth: '50%' }}
			onCancel={onCancel}
			footer={null}
			title={component.name}
			open={open}
		>
			<ComponentItem component={component} />
		</Modal>
	);
};

export default ComponentModal;
