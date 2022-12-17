import React, { FC, memo, useState } from 'react';
import { GetComponentTypeDto } from '../../../models/type/GetComponentType.dto';
import { GetComponentDto } from '../../../models/component/get-component.dto';
import { useQuery } from '@tanstack/react-query';
import ComponentService from '../../../services/component/ComponentService';
import { Button, Card, Col, Image, Row, Spin } from 'antd';
import { LoadingOutlined } from '@ant-design/icons';

interface ComponentBuildListProps {
	componentType: GetComponentTypeDto;
	onComponentAdd: (component: GetComponentDto) => void;
	onComponentDelete: (component: GetComponentDto) => void;
}

const antIcon = <LoadingOutlined style={{ fontSize: 24 }} spin />;

const ComponentBuildList: FC<ComponentBuildListProps> = memo(
	({ componentType, onComponentAdd, onComponentDelete }) => {
		const { data: components, isSuccess } = useQuery<GetComponentDto[]>({
			queryKey: [componentType.name],
			queryFn: async () =>
				await ComponentService.getComponents({
					type: componentType.name,
				}),
		});

		const [selectedComponentId, setSelectedComponentId] =
			useState<number>(0);

		const onAddButtonClick = (component: GetComponentDto) => {
			setSelectedComponentId(component.id);
			onComponentAdd(component);
		};

		const onRemoveButtonClick = (component: GetComponentDto) => {
			setSelectedComponentId(0);
			onComponentDelete(component);
		};

		return (
			<div
				style={{
					display: 'flex',
					flexDirection: 'column',
					justifyContent: 'center',
				}}
			>
				{isSuccess ? (
					components.map(component => {
						const isSelected = selectedComponentId == component.id;
						return (
							<Card
								key={component.id}
								headStyle={
									(isSelected && {
										backgroundColor: '#489da17d',
									}) ||
									undefined
								}
								title={component.name}
							>
								<Row
									align={'middle'}
									justify={'space-evenly'}
									gutter={14}
								>
									{component.photoUrl && (
										<Col>
											<Image
												width={90}
												height={90}
												src={component.photoUrl}
											/>
										</Col>
									)}
									<Col>
										{component.attributes
											.slice(0, 3)
											.map(attr => (
												<p key={attr.name}>
													{attr.name}: {attr.value}
												</p>
											))}
									</Col>
									<Col>
										{!isSelected ? (
											<Button
												onClick={() =>
													onAddButtonClick(component)
												}
											>
												Добавить
											</Button>
										) : (
											<Button
												onClick={() =>
													onRemoveButtonClick(
														component,
													)
												}
											>
												Убрать
											</Button>
										)}
									</Col>
								</Row>
							</Card>
						);
					})
				) : (
					<Spin style={{ margin: 'auto' }} indicator={antIcon} />
				)}
			</div>
		);
	},
);

export default ComponentBuildList;
