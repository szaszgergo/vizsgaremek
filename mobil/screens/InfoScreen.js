import React, { useContext } from "react";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { View } from "react-native";
import { UserContext } from "../context/UserContext";
import { Text, Button, Image } from "@rneui/themed";

export default function InfoScreen({ setIsAuthenticated }) {
  const { userData, setUserData } = useContext(UserContext);

  const handleLogout = async () => {
    try {
      await AsyncStorage.removeItem("uID");
      setUserData(null);
      setIsAuthenticated(false);
    } catch (error) {
      console.error("Hiba történt kijelentkezéskor:", error);
    }
  };


  return (
    <View style={{ flex: 1, justifyContent: "center", alignItems: "center" }}>
      {userData ? (
        <>
          <Image
            source={{ uri: `http://liftzone.hu/profile_pic/${userData.user.uProfilePic}` }}
            style={{ width: 200, height: 200, borderRadius: 100, borderColor: "#faa61ae8", borderWidth: 5 }}
          />
          <Text h3>{userData.user.uSzuleteskorinev}</Text>
          <Text h3>{userData.user.uFelhasznalonev}</Text>
          <Text>{userData.user.uemail}</Text>
          <Text>Aktív jegy: {userData.aktivjegy?.[1] || "Nincs"}</Text>
        </>
      ) : (
        <Text>Nem sikerült betölteni az adatokat.</Text>
      )}
      <Button color="error" radius="md" onPress={handleLogout}>Kijelentkezés</Button>
    </View>
  );
}
