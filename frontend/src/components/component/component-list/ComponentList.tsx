import React, {FC} from 'react';
import ComponentItem from '../component-item/ComponentItem';
import {Collapse, Typography} from 'antd';
import ComponentHeader from '../component-item/ComponentHeader';
import './ComponentList.css';
import {GetComponentDto} from '../../../models/component/get-component.dto';

interface ComponentListProps {
	components?: GetComponentDto[];
	onDelete: (component: GetComponentDto) => void
	onUpdate: (component: GetComponentDto) => void
}

const {Title} = Typography;
const ComponentList: FC<ComponentListProps> = ({components, onDelete, onUpdate}) => {
	return (
		<div className={'component-list'}>
			<Title style={{textAlign: 'center'}} level={4}>
				Список компонентов
			</Title>
			{!components?.length ? (
				<Title style={{textAlign: 'center'}} level={4}>
					Комплектующие не найдены
				</Title>
			) : (
				<Collapse>
					{components.map(component => (
						<Collapse.Panel
							showArrow={false}
							key={component.id}
							header={<ComponentHeader onUpdate={onUpdate} onDelete={onDelete} component={component}/>}
						>
							<ComponentItem
								key={component.id}
								component={component}
							/>
						</Collapse.Panel>
					))}
				</Collapse>
			)}
		</div>
	);
};

export default ComponentList;
