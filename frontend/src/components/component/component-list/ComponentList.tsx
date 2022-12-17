import React, { FC } from 'react';
import ComponentItem from '../component-item/ComponentItem';
import { Collapse, Typography } from 'antd';
import ComponentHeader from '../component-item/ComponentHeader';
import './ComponentList.css';
import { GetComponentDto } from '../../../models/component/get-component.dto';

interface ComponentListProps {
	components?: GetComponentDto[];
}

const { Title } = Typography;
const ComponentList: FC<ComponentListProps> = ({ components }) => {
	return (
		<div className={'component-list'}>
			<Title style={{ textAlign: 'center' }} level={4}>
				Список компонентов
			</Title>
			{components == null ? (
				<Title style={{ textAlign: 'center' }} level={4}>
					Комплектующие не найдены
				</Title>
			) : (
				<Collapse>
					{components.map(component => (
						<Collapse.Panel
							showArrow={false}
							key={component.id}
							header={<ComponentHeader component={component} />}
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
