package learn2crack.myprojecat;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Html;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

/**
 * Created by su004 on 2/4/2016.
 */
public class AccountSettingActivity extends AppCompatActivity {

    String urlForGet = "http://192.168.0.168/LoginLogout/myAccount.php";
    String urlForUpdate = "http://192.168.0.168/LoginLogout/updateAccount.php";
    RequestQueue requestQueue;
    // User Session Manager Class
    UserSessionManager session;

    EditText firstnameValue, lastnameValue, emailValue;
    Button save;

    protected void onCreate(Bundle savedInstanceState) {
        HttpsTrustManager.allowAllSSL();

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_acount_settings);

        firstnameValue = (EditText) findViewById(R.id.firstname);
        lastnameValue = (EditText) findViewById(R.id.lastname);
        emailValue = (EditText) findViewById(R.id.email);

        save = (Button) findViewById(R.id.save);

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
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, urlForGet, new JSONObject(params), new Response.Listener<JSONObject>() {
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
                        String email = okay.getString("email");
                        firstnameValue.setText(firstname);
                        lastnameValue.setText(lastname);
                        emailValue.setText(email);
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


        // if user click save changes
        save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                HashMap<String, String> updateParam = new HashMap<String, String>();

                String newFirstname = firstnameValue.getText().toString();
                String newLastname = lastnameValue.getText().toString();
                String newEmail = emailValue.getText().toString();
                // get user Api token
                HashMap<String, String> user = session.getUserDetails();
                String usersToken = user.get(UserSessionManager.KEY_USER_API_TOKEN);
                updateParam.put("token", usersToken);
                updateParam.put("firstname", newFirstname);
                updateParam.put("lastname", newLastname);
                updateParam.put("email", newEmail);

                requestQueue = Volley.newRequestQueue(getApplicationContext());
                JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, urlForUpdate, new JSONObject(updateParam), new Response.Listener<JSONObject>() {
                    public void onResponse(JSONObject response) {
                        try {
                            if (response.has("error")) {
                                JSONObject err = response.getJSONObject("error");
                                String error = err.getString("message");
                                Toast.makeText(getApplicationContext(), error, Toast.LENGTH_LONG).show();

                            } else if (response.has("okay")) {
                                JSONObject okay = response.getJSONObject("okay");
                                String success = okay.getString("message");
                                Toast.makeText(getApplicationContext(), success, Toast.LENGTH_LONG).show();
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
            }
        });

    }
}
