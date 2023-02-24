import React, {FC, useEffect, useState} from 'react';
import MainLayout from '../../layouts/MainLayout';
import ComponentList from '../../components/component/component-list/ComponentList';
import CreateComponentForm from '../../components/component/form/CreateComponentForm';
import {Button, Col, Form, Modal, Row} from 'antd';
import {useMutation, useQuery, useQueryClient} from '@tanstack/react-query';
import ComponentService from '../../services/component/ComponentService';
import ComponentSearch from '../../components/component/component-list/ComponentSearch';
import {ComponentQuery} from '../../services/component/component-query';
import useDebounce from '../../hooks/useDebounce';
import {userisAdmin} from '../../hooks/userisAdmin'
import UpdateComponentForm from "../../components/component/form/UpdateComponentForm";
import {GetComponentDto} from "../../models/component/get-component.dto";

const Components: FC = () => {
	const [isCreateModalOpen, setIsCreateModalOpen] = useState<boolean>(false);
	const [isUpdateModalOpen, setIsUpdateModalOpen] = useState<boolean>(false);
	const [query, setQuery] = useState<ComponentQuery>({});
	const [updateComponent, setUpdateComponent] = useState<GetComponentDto | null>(null);
	const {data: components, refetch} = useQuery({
		queryKey: ['components'],
		queryFn: async () => await ComponentService.getComponents(query),
	});
	const debouncedQuery = useDebounce(query, 400);
	const isAdmin = userisAdmin()

	useEffect(() => {
		refetch();
	}, [debouncedQuery]);

	const onQueryChange = (query: Partial<ComponentQuery>) => {
		setQuery(prevState => ({...prevState, ...query}));
	};
	const client = useQueryClient();
	const deleteComponent = useMutation({
		mutationFn: async (componentId: number) =>
			await ComponentService.deleteComponent(componentId),
		onSuccess: () => {
			client.invalidateQueries({queryKey: ['components']});
		},
	});

	const [createForm] = Form.useForm();
	const [updateForm] = Form.useForm();


	const handleCreateOk = () => {
		createForm.submit()
		setIsCreateModalOpen(false);
	};

	const handleUpdateOk = () => {
		updateForm.submit()
		setIsUpdateModalOpen(false);
	};


	const handleOnDelete = (component: GetComponentDto) => {
		deleteComponent.mutate(component.id)
	}

	const handleOnUpdate = (component: GetComponentDto) => {
		setUpdateComponent(component)
		setIsUpdateModalOpen(true)
	}

	return (
		<MainLayout>
			<Row justify={'center'} style={{marginTop: '40px'}}>
				<ComponentSearch onQueryChange={onQueryChange}/>
			</Row>
			{
				isAdmin &&
                <Row justify={'center'} style={{marginTop: '40px'}}>
                    <Button onClick={() => setIsCreateModalOpen(true)}>Создать компонент</Button>
                </Row>
			}
			<Row justify={'center'} style={{paddingTop: '30px'}}>
				<Col span={12}>
					<ComponentList onUpdate={handleOnUpdate} onDelete={handleOnDelete} components={components}/>
					<Modal
						title="Создать новый компонент"
						open={isCreateModalOpen}
						onOk={handleCreateOk}
						onCancel={() => setIsCreateModalOpen(false)}
					>
						<CreateComponentForm
							onSuccess={() => setIsCreateModalOpen(false)}
							form={createForm}
						/>
					</Modal>
					{
						updateComponent &&
                        <Modal
                            title={'Обновить компонент ' + updateComponent.name}
                            open={isUpdateModalOpen}
                            onOk={handleUpdateOk}
                            onCancel={() => setIsUpdateModalOpen(false)}
                        >
                            <UpdateComponentForm
                                onSuccess={() => setIsCreateModalOpen(false)}
                                form={updateForm}
                                component={updateComponent}
                            />
                        </Modal>
					}
				</Col>
			</Row>
		</MainLayout>
	);
};

export default Components;
