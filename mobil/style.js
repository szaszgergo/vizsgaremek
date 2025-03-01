import { StyleSheet } from "react-native";

export default StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor: "#f5f5f5", 
    padding: 20,
  },
  loader: {
    flex: 1,
    justifyContent: "center",
  },
  qrContainer: {
    backgroundColor: "#fff",
    padding: 20,
    borderRadius: 16,
    shadowColor: "#000",
    shadowOpacity: 0.2,
    shadowOffset: { width: 0, height: 4 },
    shadowRadius: 6,
    elevation: 5,
    marginBottom: 20,
  },
  qrImage: {
    width: 200,
    height: 200,
  },
  ticketType: {
    fontSize: 20,
    fontWeight: "bold",
    color: "#333",
    marginBottom: 5,
  },
  validityText: {
    fontSize: 16,
    color: "#777",
  },
  daysLeft: {
    fontSize: 24,
    fontWeight: "bold",
    color: "#faa61ae8",
  },
  noTicketText: {
    fontSize: 22,
    fontWeight: "bold",
    color: "#ff4444",
    marginBottom: 15,
  },
  buyButton: {
    backgroundColor: "#faa61ae8",
    borderRadius: 10,
    paddingHorizontal: 30,
    paddingVertical: 12,
  },
  errorText: {
    fontSize: 18,
    color: "#d9534f",
  },
});
