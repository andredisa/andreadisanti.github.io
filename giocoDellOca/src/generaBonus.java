import java.util.Random;

public class generaBonus extends Thread {
    Random r;
    casella[] v;

    public generaBonus(casella[] vet) {
        r = new Random();
        v = vet;
    }

    public void run() {
        int n;
        for (int i = 0; i < v.length; i++) {
            n = r.nextInt(5);
            v[i] = new casella();
            switch (n) {
                case 0:
                    v[i].setValore(0);
                    break;
                case 1:
                    v[i].setValore(2);
                    break;
                case 2:
                    v[i].setValore(-2);
                    break;
                case 3:
                    v[i].setValore(3);
                    break;
                case 4:
                    v[i].setValore(-3);
                    break;
            }
        }
    }
}
