import React, { FC } from 'react';
import { Col, Row } from 'antd';
import { TypeName } from '../../../models/type/types';
import { DeleteOutlined } from '@ant-design/icons';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import ComponentService from '../../../services/component/ComponentService';
import { GetComponentDto } from '../../../models/component/get-component.dto';

interface ComponentItemHeaderProps {
	component: GetComponentDto;
}

const ComponentHeader: FC<ComponentItemHeaderProps> = ({ component }) => {
	const { name, type } = component;
	const client = useQueryClient();
	const mutation = useMutation({
		mutationFn: async (componentId: number) =>
			await ComponentService.deleteComponent(componentId),
		onSuccess: () => {
			client.invalidateQueries({ queryKey: ['components'] });
		},
	});
	const handleOnClick = (
		e: React.MouseEvent<HTMLSpanElement>,
		componentId: number,
	) => {
		e.stopPropagation();
		mutation.mutate(componentId);
	};
	return (
		<div className={'component-header'}>
			<Row justify={'space-evenly'} className={'component-item'}>
				<Col>{name}</Col>
				<Col>{TypeName[type]}</Col>
				<Col
					onClick={e => handleOnClick(e, component.id)}
					className={'delete-component-icon-container'}
				>
					<DeleteOutlined />
				</Col>
			</Row>
		</div>
	);
};

export default ComponentHeader;
