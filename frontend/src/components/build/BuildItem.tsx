import React, {FC, useContext, useState} from 'react';
import {Button, Card, Image, List, Tooltip, Typography} from 'antd';
import {getCheckBuildStatus} from '../../models/build-ready-status/check-build-status';
import {GetBuildDto} from '../../models/build/get-build.dto';
import {UserContext} from '../../App';
import {GetComponentDto} from '../../models/component/get-component.dto';
import ComponentModal from '../component/component-item/ComponentModal';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faFileExcel} from '@fortawesome/free-solid-svg-icons/faFileExcel';
import {axiosInstance} from "../../config/axios";

interface BuildItemProps {
	build: GetBuildDto;
	onBuildAdd?: (build: GetBuildDto) => void;
	onBuildDelete?: (build: GetBuildDto) => void;
	onBuildUpdate?: (build: GetBuildDto) => void;
}

const BuildItem: FC<BuildItemProps> = ({
										   build,
										   onBuildDelete,
										   onBuildUpdate,
										   onBuildAdd,
									   }) => {
	const user = useContext(UserContext);
	const [isAdded, setIsAdded] = useState(false);
	const [isModalOpen, setIsModalOpen] = useState(false);
	const [modalContent, setModalContent] = useState<GetComponentDto | null>();

	const onComponentClick = (component: GetComponentDto) => {
		setModalContent(component);
		setIsModalOpen(true);
	};

	const onCancel = () => setIsModalOpen(false);

	const handleOnAdd = (build: GetBuildDto) => {
		onBuildAdd != null && onBuildAdd(build);
		setIsAdded(true);
	};

	const handleOnUpdate = (build: GetBuildDto) => {
		onBuildUpdate != null && onBuildUpdate(build);
	};

	const handleOnDelete = (build: GetBuildDto) => {
		onBuildDelete != null && onBuildDelete(build);
	};

	return (
		<div style={{padding: '0 50px'}}>
			<Typography.Title level={4}>{build.name}</Typography.Title>
			<Typography.Text italic>
				{getCheckBuildStatus(build.isReady)}
			</Typography.Text>
			<br/>
			<Typography.Paragraph>{build.description}</Typography.Paragraph>
			<Typography.Paragraph>
				Автор сборки: {build.user.firstName} {build.user.email}
			</Typography.Paragraph>
			<div>
				{build.user.id === user?.id ? (
					<div style={{display: "flex", flexDirection: 'row', alignItems: 'center'}}>
						<Button onClick={() => handleOnDelete(build)}>
							Удалить
						</Button>
						<Button onClick={() => handleOnUpdate(build)}>
							Изменить
						</Button>
						<a href={`${axiosInstance.defaults.baseURL}/builds/${build.id}/create-report`}
						   target={'_blank'}
						   style={{paddingLeft: '5px', cursor: 'pointer'}}>
							<Tooltip title="Скачать отчет формате Excel">
								<FontAwesomeIcon size={"xl"} icon={faFileExcel} style={{color: "#37c889"}}/>
							</Tooltip>

						</a>
					</div>
				) : (
					<div>
						{!isAdded ? (
							<Button onClick={() => handleOnAdd(build)}>
								Добавить к себе
							</Button>
						) : (
							<Button
								disabled
								style={{backgroundColor: '#52c41a'}}
							>
								Добавлено
							</Button>
						)}
					</div>
				)}
			</div>
			<List
				grid={{column: build.components.length}}
				dataSource={build.components}
				renderItem={component => (
					<List.Item onClick={() => onComponentClick(component)}>
						<Card
							style={{cursor: 'pointer'}}
							title={component.name}
						>
							<Image
								onClick={e => e.stopPropagation()}
								width={100}
								height={100}
								src={component.photoUrl}
							/>
						</Card>
					</List.Item>
				)}
			/>
			{modalContent != null && (
				<ComponentModal
					onCancel={onCancel}
					open={isModalOpen}
					component={modalContent}
				/>
			)}
		</div>
	);
};

export default BuildItem;
