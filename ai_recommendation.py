import sys

if len(sys.argv) < 7:
    print("Error: Not enough arguments passed.")
    sys.exit(1)

name = sys.argv[1]
age = int(sys.argv[2])
weight = float(sys.argv[3])
height = float(sys.argv[4])
goal = sys.argv[5]
activity = sys.argv[6]

bmi = weight / ((height / 100) ** 2)

if goal == "Weight Loss":
    plan = f"{name}, focus on calorie deficit with HIIT 3-4x/week. Your BMI is {bmi:.1f}."
elif goal == "Muscle Gain":
    plan = f"{name}, do resistance training 5x/week and eat protein-rich meals. Your BMI is {bmi:.1f}."
else:
    plan = f"{name}, maintain your routine with balanced diet and moderate exercise. Your BMI is {bmi:.1f}."

print(plan)
