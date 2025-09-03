from flask import Flask, request, jsonify
from flask_cors import CORS
from vertexai.preview.generative_models import GenerativeModel
from google.oauth2 import service_account
import vertexai

# Inisialisasi kredensial menggunakan file JSON
credentials = service_account.Credentials.from_service_account_file(
    "C:\laragon\www\peminjaman\projectaaa-458011-6653fa87507d.json"  # Ganti dengan path file kredensial Anda
)

# Inisialisasi Vertex AI dengan kredensial dan konfigurasi proyek
vertexai.init(
    project="projectaaa-458011",  # Ganti dengan ID proyek Anda
    location="us-central1",  # Ganti dengan lokasi Anda
    credentials=credentials
)

app = Flask(__name__)
CORS(app)  # Biar Laravel bisa akses dari domain lain (penting!)

def generate_prompt(data):
    prompt_template = """
    Anda adalah dokter spesialis jantung.  
Analisis risiko penyakit jantung berdasarkan data pasien berikut:

- No Rekam Medis : {id_pasien}
- Nama : {nama}
- Umur: {umur}
- Jenis Kelamin: {jk}
- Tekanan Darah: {blood_pressure}
- Kolesterol: {cholesterol_level}
- Kebiasaan Olahraga: {exercise_habits}
- Merokok: {smoking}
- Riwayat Keluarga: {family_heart_disease}
- Diabetes: {diabetes}
- BMI: {bmi}
- Tekanan Darah Tinggi: {high_blood_pressure}
- HDL Rendah: {low_hdl}
- LDL Tinggi: {high_ldl}
- Konsumsi Alkohol: {alcohol_consumption}
- Tingkat Stres: {stress_level}
- Jam Tidur: {sleep_hours}
- Konsumsi Gula: {sugar_consumption}
- Level Trigliserida: {triglyceride_level}
- Gula Darah Puasa: {fasting_blood_sugar}
- Level CRP: {crp_level}
- Level Homocysteine: {homocysteine_level}

Gunakan ICD-10 hanya jika tingkat risiko dan gejala sangat jelas menunjuk ke diagnosis tertentu. Jika tidak, cukup kategorikan dalam risiko tanpa kode ICD.

Selain itu, berikan kategori prediksi risiko dengan tegas dan jelas, yaitu satu dari:
- Risiko Sangat Rendah
- Risiko Rendah
- Risiko Sedang
- Risiko Tinggi
- Diagnosa Spesifik (dengan kode ICD-10 yang sesuai)

Berikan hasil dalam format berikut:

1. Prediksi Risiko
2. Penjelasan Klinis
3. Analisis Faktor Risiko yang Memungkinkan Berbasis ICD-10
4. Saran Medis untuk Pasien
5. Disclaimer Mengenai Hasil Prediksi
"""

    return prompt_template.format(
        id_pasien=data["id_pasien"],
        nama=data["nama"],
        umur=data["umur"],
        jk=data["jk"],
        blood_pressure=data["blood_pressure"],
        cholesterol_level=data["cholesterol_level"],
        exercise_habits=data["exercise_habits"],
        smoking=data["smoking"],
        family_heart_disease=data["family_heart_disease"],
        diabetes=data["diabetes"],
        bmi=data["bmi"],
        high_blood_pressure=data["high_blood_pressure"],
        low_hdl=data["low_hdl"],
        high_ldl=data["high_ldl"],
        alcohol_consumption=data["alcohol_consumption"],
        stress_level=data["stress_level"],
        sleep_hours=data["sleep_hours"],
        sugar_consumption=data["sugar_consumption"],
        triglyceride_level=data["triglyceride_level"],
        fasting_blood_sugar=data["fasting_blood_sugar"],
        crp_level=data["crp_level"],
        homocysteine_level=data["homocysteine_level"]
    )

@app.route('/predict-heart', methods=['POST'])
def predict():
    data = request.json
    print(data)
    prompt = generate_prompt(data)
    
    model = GenerativeModel("gemini-1.5-pro")
   
    
    try:
        response = model.generate_content(prompt)
        return jsonify({"prediction": response.text})
    except Exception as e:
        return jsonify({"error": str(e)}), 500


if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5000, debug=True)
