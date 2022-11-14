import React, { FC } from 'react';
import { GetComponentDto } from '../../../models/component/get-component.dto';
import './ComponentItem.css';
import { Col, Image, Row, Typography } from 'antd';

export interface ComponentItemProps {
	component: GetComponentDto;
}

const { Paragraph, Text, Title } = Typography;

const ComponentItem: FC<ComponentItemProps> = ({ component }) => {
	const { name, description, id, type, photoUrl, attributes } = component;

	return (
		<Row>
			<Col span={16}>
				<Typography>
					<Paragraph>
						<Title level={5}>Наименование</Title>
						{name}
					</Paragraph>
					<Paragraph>
						<Title level={5}>Описание</Title>
						{description}
					</Paragraph>
					<Paragraph>
						<Title level={5}>Характеристики</Title>
					</Paragraph>
					<Paragraph>
						{attributes.map(attribute => (
							<div key={attribute.name}>
								<Text strong>{attribute.name}: </Text>
								<Text>{attribute.value}</Text>
							</div>
						))}
					</Paragraph>
				</Typography>
			</Col>
			<Col>
				<Image width={200} src={photoUrl} />
			</Col>
		</Row>
	);
};
export default ComponentItem;
