import React, { useState, useContext } from "react";
import { View, Text, TextInput, Button, StyleSheet } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { UserContext } from "../context/UserContext";

export default function AuthScreen({ setIsAuthenticated }) {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const { setUserData, fetchUserData } = useContext(UserContext); 

  const handleLogin = async () => {
    try {
      const response = await fetch("http://liftzone.hu/api/login/", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password }),
      });

      const data = await response.json();

      if (data.status === 200) {
        await AsyncStorage.setItem("uID", data.data.uID.toString());

        setUserData(data.data); 
        await fetchUserData(); 

        setIsAuthenticated(true);
      } else {
        alert(data.uzenet);
      }
    } catch (error) {
      alert("Nem sikerült a bejelentkezés. Kérjük próbáld újra!");
      console.error("Login error:", error);
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Bejelentkezés</Text>
      <TextInput
        style={styles.input}
        placeholder="Felhasznalonev"
        value={username}
        onChangeText={setUsername}
      />
      <TextInput
        style={styles.input}
        placeholder="Jelszo"
        secureTextEntry
        value={password}
        onChangeText={setPassword}
      />
      <Button color="#ffc107" title="Bejelentkezés" onPress={handleLogin} />
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: "center", alignItems: "center" },
  title: { fontSize: 24, fontWeight: "bold", marginBottom: 20 },
  input: {
    width: "80%",
    padding: 10,
    marginVertical: 10,
    borderWidth: 1,
    borderColor: "#ccc",
    borderRadius: 5,
  },
});
