import React, { useEffect, useState } from 'react';
import { Alert } from 'react-native';
import styled from 'styled-components/native';
import { useNavigation } from '@react-navigation/native';

import Api from '../Api';

const Area = styled.View`
    background-color: #FFFFFF;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 20px;
`;

const UserArea = styled.View`
    flex: 1;
    flex-direction: row;
    align-items: center;
`;

const Avatar = styled.Image`
    width: 56px;
    height: 56px;
    border-radius: 20px;
    margin-right: 20px;
`;

const UserName = styled.Text`
    font-size: 18px;
    font-weight: bold;
    color: #000000;
`;


const SplitArea = styled.View`
    flex-direction: row;
    justify-content: space-between;
    margin-top: 10px;
`;



const ServiceText = styled.Text`
    font-size: 16px;
    font-weight: bold;
    color: #000000;
`;

const DateText = styled.Text`
    font-size: 16px;
    font-weight: bold;
    color: #FFFFFF;
    padding: 10px 15px;
    border-radius: 10px;
    background-color: #4EADBE;
`;

const ButtonText = styled.Text`
    font-size: 16px;
    font-weight: bold;
    color: #FFFFFF;
`;

const DeleteButton = styled.TouchableOpacity`
    font-size: 16px;
    font-weight: bold;
    color: #FFFFFF;
    padding: 10px 15px;
    border-radius: 10px;
    background-color: #ff0000;
`;


export default ({ data, refreshFunction }) => {
    const [loading, setLoading] = useState(false);
    const [list, setList] = useState([]);

    const navigation = useNavigation();

    let d = data.datetime.split(' ');


    // Horário
    let time = d[1].substring(0, 5);

    // Data
    let date = new Date(d[0]);
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();

    month = month < 10 ? '0' + month : month;
    day = day < 10 ? '0' + day : day;
    let dateString = `${day}/${month}/${year}`;

    const handleRemoveButton = () => {
        Alert.alert(
            'Confirmação',
            'Tem certeza que deseja cancelar o agendamento?',

            [{ text: 'Sim, tenho certeza', onPress: deleteAppointment },
            { text: 'Cancelar', onPress: null, style: 'cancel' }
            ]
        );
    }

    const deleteAppointment = async () => {
        const result = await Api.deleteAppointment(data.id);
        console.log("ID: " + data.id);
        if (result.error === '') {
            refreshFunction();

        } else {
            alert(result.error);
        }
    }







    return (
        <Area>

            <UserArea>
                <Avatar source={{ uri: data.service.avatar }} />
                <UserName>{data.service.name}</UserName>
            </UserArea>

            <SplitArea>
                <ServiceText>{data.service.name}</ServiceText>
                <ServiceText>R$ {data.service.price}</ServiceText>
            </SplitArea>

            <SplitArea>
                <DateText>{dateString}</DateText>
                <DateText>{time}</DateText>

                <DeleteButton onPress={handleRemoveButton}>
                    <ButtonText>Cancelar</ButtonText>
                </DeleteButton>
            </SplitArea>

        </Area>
    );
}

