import React, { FC } from 'react';
import { useQuery } from '@tanstack/react-query';
import ComponentService from '../../../services/component/ComponentService';
import ComponentItem from '../component-item/ComponentItem';
import { Collapse, Typography } from 'antd';
import ComponentHeader from '../component-item/ComponentHeader';
import './ComponentList.css';

const { Title } = Typography;
const ComponentList: FC = () => {
	const query = useQuery({
		queryKey: ['components'],
		queryFn: ComponentService.getComponents,
	});

	return (
		<div className={'component-list'}>
			<Title style={{ textAlign: 'center' }} level={4}>
				Список компонентов
			</Title>
			{!query.data?.length ? (
				<Title style={{ textAlign: 'center' }} level={4}>
					Комплектующие не найдены
				</Title>
			) : (
				<Collapse>
					{query.data?.map(component => (
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
