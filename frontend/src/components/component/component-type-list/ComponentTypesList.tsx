import React, { FC, ReactNode } from 'react';
import { GetComponentTypeDto } from '../../../models/type/GetComponentType.dto';
import { Collapse, Typography } from 'antd';
import { MinusCircleOutlined, PlusCircleOutlined } from '@ant-design/icons';
import { TypeName } from '../../../models/type/types';
import ComponentBuildList from '../component-build-list/ComponentBuildList';
import './ComponentTypesList.css';
import { GetComponentDto } from '../../../models/component/get-component.dto';

interface ComponentTypesListProps {
	label?: string;
	onComponentAdd: (component: GetComponentDto) => void;
	onComponentDelete: (component: GetComponentDto) => void;
	items: GetComponentTypeDto[];
}

const ComponentTypesList: FC<ComponentTypesListProps> = ({
	items,
	label,
	onComponentAdd,
	onComponentDelete,
}) => {
	return (
		<div>
			<Typography.Title style={{ textAlign: 'center' }}>
				{label}
			</Typography.Title>
			<Collapse
				style={{ width: '550px' }}
				expandIconPosition={'end'}
				expandIcon={props => customExpandIcon(props)}
			>
				{items.map(item => (
					<Collapse.Panel
						key={item.id}
						header={TypeName[item.name] || item.name}
					>
						<ComponentBuildList
							onComponentAdd={onComponentAdd}
							onComponentDelete={onComponentDelete}
							componentType={item}
						/>
					</Collapse.Panel>
				))}
			</Collapse>
		</div>
	);
};

const customExpandIcon = (props: { isActive?: boolean }): ReactNode => {
	const iconProps = { style: { fontSize: '150%' } };
	return !props.isActive ? (
		<PlusCircleOutlined {...iconProps} />
	) : (
		<MinusCircleOutlined {...iconProps} />
	);
};

export default ComponentTypesList;
