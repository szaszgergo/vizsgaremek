import React, { useContext, useState } from "react";
import { UserContext } from "../context/UserContext";
import { View, StyleSheet } from "react-native";
import { Text, Button, Card, Icon, Divider, Switch } from "@rneui/themed";
import { Picker } from "@react-native-picker/picker";

export default function PassPurchaseScreen({ route, navigation }) {
    const { pass } = route.params;
    const isActivatable = pass.tpAr === null;
    const { userData, fetchUserData } = useContext(UserContext);
    const [checked, setChecked] = useState(false);
    const [reminderTime, setReminderTime] = useState("0");

    const handleActivate = async () => {
        try {
            const response = await fetch("http://liftzone.hu/api/jegyaktivalas/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "uID": userData.user.uID,
                    "jID": pass.tpID,
                }),
            });

            const data = await response.json();

            if (data.status === 200) {
                alert("Jegyedet sikeresen aktiváltad!");
            } else {
                alert(`Nem sikerült aktiválni a jegyed: ${data.uzenet}`);
            }
        } catch (error) {
            alert("Hiba történt az aktiválás során!");
            console.error(error);
        }
        await fetchUserData();
        await handleReminder();
        navigation.goBack();
    };

    const handleReminder = async () => {
        try {
            const response = await fetch("http://liftzone.hu/api/ertesites/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "uID": userData.user.uID,
                    "jID": pass.tpID,
                    "ertNappalElotte": reminderTime,
                    "ertLeiras": `A(z) ${pass.tpNev} nevű jegyed lejár!`,
                }),
            });

            const data = await response.json();

            if (data.status === 200) {
                alert("Emlékeztető sikeresen beállítva!");
            } else {
                alert(`Nem sikerült beállítani az emlékeztetőt: ${data.uzenet}`);
            }
        } catch (error) {
            alert("Hiba történt az emlékeztető beállítása során!");
            console.error(error);
        }
        await fetchUserData();
        navigation.goBack();
    };

    const handlePurchase = async () => {
        try {
            const response = await fetch("http://liftzone.hu/api/jegyvasarlas/", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ "uID": userData.user.uID, "tpID": pass.tpID }),
            });
            const data = await response.json();

            if (data.status === 200) {
                alert("Sikeres vásárlás!");
            } else {
                alert(`Vásárlás sikertelen: ${data.uzenet}`);
            }
        } catch (error) {
            alert("Hiba történt a vásárlás során!");
            console.error(error);
        }
        await fetchUserData();
        navigation.goBack();
    };


    return (
        <View style={styles.container}>
            <Icon
                name="arrow-left"
                type="font-awesome"
                color="#333"
                size={24}
                onPress={() => navigation.goBack()}
                containerStyle={styles.backButton}
            />
            <View style={styles.container}>
                <Card containerStyle={styles.card}>
                    <View style={styles.cardHeader}>
                        <Icon name="ticket" type="font-awesome" color="#faa61a" size={24} />
                        <Icon name="info-circle" type="font-awesome" color="#555" size={22} />
                    </View>

                    <View style={styles.passInfo}>
                        <Text h3 style={styles.title}>{pass.tpNev}</Text>
                        <Divider orientation="vertical" width={4} color="#faa61a" />
                        <Text style={styles.price}>{pass.tpAr !== null ? `${pass.tpAr} HUF` : "Aktiválható"}</Text>
                    </View>
                </Card>
                {isActivatable ? (
                    <Card containerStyle={styles.card}>
                        <View style={styles.passInfo}>
                            <Icon name="calendar" type="font-awesome" color="#faa61a" size={24} />
                            <Text style={{ fontWeight: "bold", fontSize: 15 }}>Emlékeztess a lejáratról!</Text>
                            <Switch value={checked}
                                trackColor={{ false: "#767577", true: "orange" }}
                                thumbColor={checked ? "#f4f3f4" : "#f4f3f4"}
                                onValueChange={(value) => setChecked(value)} />
                        </View>
                        {checked && (
                            <Picker
                                selectedValue={reminderTime}
                                onValueChange={(time) => setReminderTime(time)}>
                                <Picker.Item label="Lejárat napján" value="0" />
                                <Picker.Item label="Egy nappal előtte" value="1" />
                                <Picker.Item label="Egy héttel előtte" value="7" />
                            </Picker>)}
                    </Card>) : null}
            </View>
            <Button
                title={isActivatable ? "Jegy aktiválása" : "Jegy vásárlása"}
                onPress={isActivatable ? handleActivate : handlePurchase}
                buttonStyle={isActivatable ? styles.activateButton : styles.purchaseButton}
            />
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: "center",
        alignItems: "center",
        padding: 20,
        backgroundColor: "#f5f5f5",
        width: "100%",
    },
    backButton: {
        position: "absolute",
        top: 50,
        left: 20,
    },
    card: {
        width: "100%",
        borderRadius: 10,
        padding: 20,
        shadowColor: "#000",
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.2,
        shadowRadius: 4,
        elevation: 5,
    },
    cardHeader: {
        flexDirection: "row",
        justifyContent: "space-between",
    },
    passInfo: {
        flexDirection: "row",
        justifyContent: "space-between",
        alignItems: "center",
    },
    title: {
        fontSize: 20,
        fontWeight: "bold",
        flex: 1,
    },
    price: {
        fontSize: 18,
        color: "#888",
        marginLeft: 10,
    },
    activateButton: {
        backgroundColor: "green",
        borderRadius: 10,
    },
    purchaseButton: {
        backgroundColor: "blue",
        borderRadius: 10,
    },

});
