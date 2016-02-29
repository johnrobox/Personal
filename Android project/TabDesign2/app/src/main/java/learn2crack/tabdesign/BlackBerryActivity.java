package learn2crack.tabdesign;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

public class BlackBerryActivity extends Activity {
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        TextView textview = new TextView(this);
        textview.setText("This is BlackBerry tab");
        setContentView(textview);
    }
}