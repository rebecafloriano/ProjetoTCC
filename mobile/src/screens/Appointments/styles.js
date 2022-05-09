import styled from 'styled-components/native';

export const Container = styled.SafeAreaView`
    flex: 1;
    background-color: #63C2D1;
`;

export const Scroller = styled.ScrollView`
    flex: 1;
    padding: 0 20px;
`;

export const ListArea = styled.View`
    margin-top: 20px;
    margin-bottom: 20px;
`;

export const ListItemDelete = styled.View`

`;

export const EmptyWarning = styled.Text`
    text-align: center;
    margin-top: 30px;
    color: #FFFFFF;
    font-size: 14px;
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
