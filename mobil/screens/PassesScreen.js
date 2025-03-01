import React, { useEffect, useState, useContext } from "react";
import { View, ActivityIndicator, SectionList, TouchableOpacity } from "react-native";
import { Text, Icon } from "@rneui/themed";
import { UserContext } from "../context/UserContext";
import { useNavigation } from "@react-navigation/native";

export default function PassesScreen() {
  const navigation = useNavigation();
  const { userData } = useContext(UserContext);
  const [passes, setPasses] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchPasses = async () => {
    try {
      const response = await fetch("http://liftzone.hu/api/jegyek/");
      const result = await response.json();

      if (result.status === 200) {
        setPasses([
          {
            title: "Aktiválható jegyeid",
            data: userData.aktivalhato_jegyek.map(jegy => ({
              tpID: jegy.jID,
              tpNev: jegy.jNev,
              tpAr: null,
              tpHossz: null,
              tpAlkalmak: jegy.jAlkalmak,
            })),
          },
          { title: "Felnőtt", data: result.data.tipusok.slice(0, 9) },
          { title: "Diák/Nyugdíjas", data: result.data.tipusok.slice(9, 17) },
        ]);
      } else {
        alert("Hiba történt az adatok lekérésekor.");
      }
    } catch (error) {
      console.error("Failed to fetch passes", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchPasses();
    const unsubscribe = navigation.addListener("focus", fetchPasses);
    return unsubscribe;
  }, [userData]);

  const handlePassPress = (pass) => {
    navigation.navigate("PassPurchase", { pass, refreshPasses: fetchPasses });
  };

  if (loading) return <ActivityIndicator size="large" style={{ flex: 1, justifyContent: "center" }} />;

  return (
    <View style={{ flex: 1, padding: 16, backgroundColor: "#F5F5F5" }}>
      <SectionList
        sections={passes}
        keyExtractor={(item) => item.tpID.toString()}
        renderSectionHeader={({ section: { title } }) => (
          <View style={{ paddingVertical: 10, backgroundColor: "#faa61a", borderRadius: 10, marginVertical: 8 }}>
            <Text style={{ fontSize: 18, fontWeight: "bold", paddingLeft: 10 }}>{title}</Text>
          </View>
        )}
        renderItem={({ item }) => (
          <TouchableOpacity
            style={{
              flexDirection: "row",
              justifyContent: "space-between",
              alignItems: "center",
              backgroundColor: "white",
              padding: 15,
              marginVertical: 5,
              borderRadius: 10,
              shadowColor: "#000",
              shadowOffset: { width: 0, height: 2 },
              shadowOpacity: 0.1,
              shadowRadius: 3,
            }}
            onPress={() => handlePassPress(item)}
          >
            <View>
              <Text style={{ fontSize: 16, fontWeight: "bold" }}>{item.tpNev}</Text>
              {item.tpAr !== null && <Text style={{ color: "#888" }}>{item.tpAr} HUF</Text>}
            </View>
            <Icon name="arrow-right-circle" type="feather" color="#ffc107" size={28} />
          </TouchableOpacity>
        )}
      />
    </View>
  );
}
