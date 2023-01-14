import React, { FC, memo, useEffect, useState } from 'react';
import { GetComponentTypeDto } from '../../../models/type/GetComponentType.dto';
import { GetComponentDto } from '../../../models/component/get-component.dto';
import { useQuery } from '@tanstack/react-query';
import ComponentService from '../../../services/component/ComponentService';
import { Button, Card, Col, Image, Input, Row, Spin } from 'antd';
import { LoadingOutlined } from '@ant-design/icons';
import ComponentModal from '../component-item/ComponentModal';
import { ComponentQuery } from '../../../services/component/component-query';
import useDebounce from '../../../hooks/useDebounce';

interface ComponentBuildListProps {
	componentType: GetComponentTypeDto;
	onComponentAdd: (component: GetComponentDto) => void;
	onComponentDelete: (component: GetComponentDto) => void;
}

const antIcon = <LoadingOutlined style={{ fontSize: 24 }} spin />;

const ComponentBuildList: FC<ComponentBuildListProps> = memo(
	({ componentType, onComponentAdd, onComponentDelete }) => {
		const [query, setQuery] = useState<Omit<ComponentQuery, 'type'>>({});
		const {
			data: components,
			isSuccess,
			refetch,
		} = useQuery<GetComponentDto[]>({
			queryKey: [componentType.name],
			queryFn: async () =>
				await ComponentService.getComponents({
					type: componentType.name,
					...query,
				}),
			refetchOnWindowFocus: false,
		});

		const debouncedQuery = useDebounce(query, 400);

		useEffect(() => {
			refetch();
		}, [debouncedQuery]);

		const [isModalOpen, setIsModalOpen] = useState(false);
		const [modalContent, setModalContent] =
			useState<GetComponentDto | null>();

		const onComponentClick = (component: GetComponentDto) => {
			setModalContent(component);
			setIsModalOpen(true);
		};

		const onCancel = () => setIsModalOpen(false);

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
				<Input
					size={'middle'}
					style={{ width: '50%' }}
					placeholder={'Название'}
					onChange={e =>
						setQuery({
							search: e.currentTarget.value,
						})
					}
				/>
				{isSuccess ? (
					components.map(component => {
						const isSelected = selectedComponentId == component.id;
						return (
							<>
								<Card
									style={{ cursor: 'pointer' }}
									onClick={() => onComponentClick(component)}
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
													onClick={e =>
														e.stopPropagation()
													}
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
														{attr.name}:{' '}
														{attr.value}
													</p>
												))}
										</Col>
										<Col>
											{!isSelected ? (
												<Button
													onClick={e => {
														e.stopPropagation();
														onAddButtonClick(
															component,
														);
													}}
												>
													Добавить
												</Button>
											) : (
												<Button
													onClick={e => {
														e.stopPropagation();
														onRemoveButtonClick(
															component,
														);
													}}
												>
													Убрать
												</Button>
											)}
										</Col>
									</Row>
								</Card>
								{modalContent != null && (
									<ComponentModal
										component={modalContent}
										open={isModalOpen}
										onCancel={onCancel}
									/>
								)}
							</>
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
