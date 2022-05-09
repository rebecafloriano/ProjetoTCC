import React, { useState } from 'react';
import {
    Container,
    SearchArea,
    SearchInput,
    Scroller,
    LoadingIcon,
    ListArea,
    EmptyWarning,

} from './styles';

import DoctorItem from '../../components/DoctorItem';
import Api from '../../Api';

export default () => {

    const [searchText, setSearchText] = useState('');
    const [loading, setLoading] = useState(false);
    const [emptyList, setEmptyList] = useState(false);
    const [list, setList] = useState([]);

    const searchDoctors = async () => {
        setEmptyList(false);
        setLoading(true);
        setList([]);

        if (searchText !== '') {
            let res = await Api.search(searchText);
            if (res.error == '') {
                if (res.list.length > 0) {
                    setList(res.list);
                } else {
                    setEmptyList(true);
                }

            } else {
                alert("Erro: " + res.error);
            }
        }

        setLoading(false);
    }

    return (
        <Container>
            <SearchArea>
                <SearchInput
                    placeholder="Nome da especialidade"
                    placeholderTextColor="#FFFFFF"
                    value={searchText}
                    onChangeText={t => setSearchText(t)}
                    onEndEditing={searchDoctors}
                    returnKeyType="search"
                    autoFocus
                    slectTextOnFocus
                />
            </SearchArea>

            <Scroller>
                {loading &&
                    <LoadingIcon size="large" color="#FFFFFF" />
                }

                {emptyList &&
                    <EmptyWarning>Não encontramos médicos com o nome "{searchText}"</EmptyWarning>
                }

                <ListArea>
                    {list.map((item, k) => (
                        <DoctorItem key={k} data={item} />
                    ))}
                </ListArea>

            </Scroller>

        </Container>
    );
}
