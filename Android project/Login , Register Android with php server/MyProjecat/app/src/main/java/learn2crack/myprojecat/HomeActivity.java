package learn2crack.myprojecat;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Html;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.util.HashMap;

/**
 * Created by su004 on 2/3/2016.
 */
public class HomeActivity extends AppCompatActivity {

    RequestQueue requestQueue;
    // User Session Manager Class
    UserSessionManager session;
    Button logout, settings;
    String url = "http://192.168.0.168/LoginLogout/myAccount.php";
    TextView nameLabel;

    protected void onCreate(Bundle savedInstanceState) {
        HttpsTrustManager.allowAllSSL();

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        logout = (Button) findViewById(R.id.logout);
        settings = (Button) findViewById(R.id.settings);
        nameLabel = (TextView) findViewById(R.id.nameLabel);

        // Session class instance
        session = new UserSessionManager(getApplicationContext());

        // get user data from session
        HashMap<String, String> user = session.getUserDetails();

        // this is for the request
        HashMap<String, String> params = new HashMap<String, String>();

        // get user Api token
        String usersToken = user.get(UserSessionManager.KEY_USER_API_TOKEN);
        params.put("token", usersToken);

        requestQueue = Volley.newRequestQueue(getApplicationContext());
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, url, new JSONObject(params), new Response.Listener<JSONObject>() {
            public void onResponse(JSONObject response) {
                try {
                    if (response.has("error")) {
                        JSONObject err = response.getJSONObject("error");
                        String error = err.getString("message");
                        Toast.makeText(getApplicationContext(), error, Toast.LENGTH_LONG).show();

                    } else if (response.has("okay")) {
                        JSONObject okay = response.getJSONObject("okay");
                        String firstname = okay.getString("firstname");
                        String lastname = okay.getString("lastname");
                        nameLabel.setText(Html.fromHtml("<b>Welcome</b>  " + firstname + " " + lastname));
                    }
                } catch (JSONException e) {
                    e.printStackTrace();

                }
            }

        }, new Response.ErrorListener() {
            public void onErrorResponse(VolleyError error) {
            }
        });
        requestQueue.add(request);
        // end


        // if the user click to logout button
        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                session.logoutUser();
            }
        });

        // if the user click the settings button
        settings.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gotoSettings = new Intent(getApplicationContext(), AccountSettingActivity.class);
                startActivity(gotoSettings);
            }
        });

    }


    @Override
    protected void onResume() {
        super.onResume();
        // check
        if (!session.isUserLoggedIn()) {
            Intent gotoPage = new Intent(getApplicationContext(), MainActivity.class);
            startActivity(gotoPage);
        }
    }

}
