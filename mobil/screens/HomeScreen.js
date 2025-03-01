import React, { useContext } from "react";
import { View, ActivityIndicator, Image } from "react-native";
import { UserContext } from "../context/UserContext";
import { useNavigation } from "@react-navigation/native";
import { Text, Button } from "@rneui/themed";

import styles from "../style";

export default function HomeScreen() {
    const navigation = useNavigation();
    const { userData, loading } = useContext(UserContext);

    if (loading) return <ActivityIndicator size="large" style={styles.loader} />;

    return (
        <View style={styles.container}>
            {userData ? (
                <>
                    {userData.aktivjegy && userData.aktivjegy[0] ? (
                        <>
                            <View style={styles.qrContainer}>
                                <Image
                                    source={{ uri: `https://api.qrserver.com/v1/create-qr-code/?data=${userData.user.uUID}&size=200x200` }}
                                    style={styles.qrImage}
                                />
                            </View>

                            <Text h4 style={styles.ticketType}>{userData.aktivjegy[1]}</Text>

                            <Text style={styles.validityText}>ÉRVÉNYES:</Text>

                            <Text style={styles.daysLeft}>
                                {Math.ceil(
                                    (new Date(userData.aktivjegy[0].jLejarat) - new Date()) / (1000 * 60 * 60 * 24)
                                )} NAP
                            </Text>
                        </>
                    ) : (
                        <>
                            <Text h3 style={styles.noTicketText}>Nincs aktív jegyed!</Text>
                            <Button
                                onPress={() => navigation.navigate("Passes")}
                                title="Vásárlás"
                                buttonStyle={styles.buyButton}
                                titleStyle={{ fontSize: 18 }}
                            />
                        </>
                    )}
                </>
            ) : (
                <Text style={styles.errorText}>Bakfitty!</Text>
            )}
        </View>
    );
}
